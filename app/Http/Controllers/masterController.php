<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ekskuls;
use App\Models\EkskulUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class masterController extends Controller
{
    public function getUsers()
    {
        $users = User::whereIn('role', ['pembina', 'pengurus'])->get(); // Ambil pembina dan pengurus
        return response()->json($users);
    }

    public function getBlogs()
    {
        $blogs = Blogs::with('blogImages')
                ->where('is_banned', false)
                ->latest() // Mengurutkan dari yang terbaru
                ->get();

        $title = 'Data Blogs';
        // dd($ekskuls->toArray());

        return view('master.dataBlogs', compact('blogs', 'title'));
    }

    public function bannedBlogs()
    {
        $blogs = Blogs::with('blogImages')
                ->where('is_banned', true)
                ->latest() // Mengurutkan dari yang terbaru
                ->get();
                
        $title = 'Banned Blogs';
        // dd($ekskuls->toArray());

        return view('master.bannedBlogs', compact('blogs', 'title'));
    }

    public function index(){
        return view('master/masterDashboard', [
            'title' => 'Dashboard Master Admin',
        ]);
    }
    
    public function dataPembina()
    {

        // Ambil semua user dengan role 'pembina' dan ekskul yang dibina
        $pembinas = User::where('role', 'pembina')->with('ekskuls')->get();

        return view('master.pembinaEkskul', [
            'title' => 'Data Pembina Ekskul',
            'datas' => $pembinas // Ambil hanya user dengan role 'pembina'
        ]);
    }
    

    public function dataPengurus()
    {

        // Ambil semua user dengan role 'pembina' dan ekskul yang dibina
        $pengurus = User::where('role', 'pengurus')->with('ekskuls')->get();

        return view('master.pengurusEkskul', [
            'title' => 'Data Pengurus Ekskul',
            'datas' => $pengurus // Ambil hanya user dengan role 'pembina'
        ]);
    }
    
    public function dataEkskul()
    {
        $ekskuls = Ekskuls::with('users')->get();

        return view('master.listEkskul', [
            'title' => 'Data Ekskul',
            'datas' => $ekskuls,
            'pembinas' => User::where('role', 'pembina')->get(),
            'pengurus' => User::where('role', 'pengurus')->get(),
        ]);
    }

    public function savePembina(Request $request){
        
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],
        [ 
            'name.required' => 'Nama wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Password wajib diisi.'
        ]);

        $create = new User();
        $create->name = $request->name;
        $create->email= $request->email;
        $create->no_hp = $request->noHp;
        $create->nip = $request->nip;
        $create->pp = "profile.png";
        $create->role = "pembina";
        $create->password = Hash::make($request->password);
        $create->save();
        
        return back()->with('success');
    }

    public function savePengurus(Request $request){
        
        $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:users,nis',
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],
        [ 
            'name.required' => 'Nama wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS ini sudah terdaftar!',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Password wajib diisi.'
        ]);

        $create = new User();
        $create->name = $request->name;
        $create->email= $request->email;
        $create->no_hp = $request->noHp;
        $create->nis = $request->nis;
        $create->pp = "profile.png";
        $create->role = "pengurus";
        $create->password = Hash::make($request->password);
        $create->save();
        
        return back()->with('success');
    }

    public function saveEkskul(Request $request) {
        try {
            // Validasi input
            $request->validate([
                'nama_ekskul' => 'required|string|max:255',
                'users' => 'required|array', // Validasi untuk array pembina
                'id_pengurus' => 'nullable|array', // Validasi untuk array pengurus (optional)
                'users.*' => 'exists:users,id', // Pastikan semua id di users ada di tabel users
                'id_pengurus.*' => 'exists:users,id', // Pastikan semua id di id_pengurus ada di tabel users
            ]);
    
            DB::beginTransaction();
    
            // Simpan ekskul baru
            $ekskul = Ekskuls::create([
                'nama_ekskul' => $request->nama_ekskul,
            ]);
    
            // Simpan pembina ke ekskul_users
            foreach ($request->users as $userId) {
                EkskulUsers::create([
                    'id_ekskul' => $ekskul->id,
                    'id_user' => $userId
                ]);
            }
    
            // Simpan pengurus ke ekskul_users jika ada
            if ($request->has('id_pengurus')) {
                foreach ($request->id_pengurus as $pengurusId) {
                    EkskulUsers::create([
                        'id_ekskul' => $ekskul->id,
                        'id_user' => $pengurusId
                    ]);
                }
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Ekskul berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteEkskul($id){
        $Ekskul = Ekskuls::findOrFail($id);
        
        // Hapus relasi ekskul dengan pengguna sebelum menghapus ekskul
        $Ekskul->users()->detach();
        
        $Ekskul->delete();

        return response()->json(['message' => 'Ekskul berhasil dihapus!']);
    }

    public function deletePembina($id){
        $User = User::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    public function banBlog(Request $request, $id){

        $update = Blogs::find($id);
        $update->is_banned = true;
        $update->save();
        
        return back()->with('success');
    }

    public function destroy($id)
    {
        // Cari blog berdasarkan ID
        $blog = Blogs::findOrFail($id);

        // Hapus semua gambar terkait di storage dan database
        foreach ($blog->blogImages as $image) {
            Storage::delete('public/blogs/' . $image->image_path);
            $image->delete();
        }

        // Hapus blog dari database
        $blog->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('get.bannedBlogs')->with('success', 'Blog berhasil dihapus.');
    }

    public function updatePembina(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'nip' => [
                'required',
                Rule::unique('users', 'nip')->ignore($id)
            ],
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($id)
            ],
        ],[
            'name.required' => 'Nama wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
        ]);

        $update = User::find($id);
        $update->name = $request->name;
        $update->email= $request->email;
        $update->no_hp = $request->noHp;
        $update->nip = $request->nip;
        $update->pp = "profile.png";
        $update->role = "pembina";
        $update->save();
        
        return back()->with('success');
    }

    public function updatePengurus(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'nis' => [
                'required',
                Rule::unique('users', 'nis')->ignore($id)
            ],
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($id)
            ],
        ],[
            'name.required' => 'Nama wajib diisi.',
            'nis.required' => 'NIP wajib diisi.',
            'nis.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
        ]);

        $update = User::find($id);
        $update->name = $request->name;
        $update->email= $request->email;
        $update->no_hp = $request->noHp;
        $update->nis = $request->nis;
        $update->pp = "profile.png";
        $update->save();
        
        return back()->with('success');
    }

    public function dataEdit($id)
    {
        try {
            $ekskul = Ekskuls::with(['users'])->findOrFail($id);
            
            // Pisahkan pembina dan pengurus berdasarkan role
            $pembina = $ekskul->users->where('role', 'pembina')->values();
            $pengurus = $ekskul->users->where('role', 'pengurus')->values();

            $response = [
                'ekskul' => [
                    'id' => $ekskul->id,
                    'nama_ekskul' => $ekskul->nama_ekskul,
                ],
                'pembina' => $pembina->isNotEmpty() ? $pembina->toArray() : [],
                'pengurus' => $pengurus->isNotEmpty() ? $pengurus->toArray() : [],
            ];
            
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error("Error fetching dataEdit: " . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data ekskul.'], 500);
        }
    }

    public function updateEkskul(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_ekskul' => 'required|string|max:255',
                'users' => 'required|array',
                'users.*' => 'exists:users,id',
                'id_pengurus' => 'nullable|array',
                'id_pengurus.*' => 'exists:users,id'
            ], [
                'nama_ekskul.required' => 'Nama Ekskul wajib diisi',
            ]);

            DB::beginTransaction();

            $ekskul = Ekskuls::findOrFail($id);
            $ekskul->update([
                'nama_ekskul' => $request->nama_ekskul
            ]);

            // Sinkronisasi pembina
            EkskulUsers::where('id_ekskul', $ekskul->id)->whereIn('id_user', $request->users)->delete();
            foreach ($request->users as $userId) {
                EkskulUsers::updateOrCreate([
                    'id_ekskul' => $ekskul->id,
                    'id_user' => $userId
                ], [
                    'id_ekskul' => $ekskul->id,
                    'id_user' => $userId
                ]);
            }

            // Sinkronisasi pengurus
            EkskulUsers::where('id_ekskul', $ekskul->id)->whereIn('id_user', $request->id_pengurus ?? [])->delete();
            if ($request->has('id_pengurus')) {
                foreach ($request->id_pengurus as $pengurusId) {
                    EkskulUsers::updateOrCreate([
                        'id_ekskul' => $ekskul->id,
                        'id_user' => $pengurusId
                    ], [
                        'id_ekskul' => $ekskul->id,
                        'id_user' => $pengurusId
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Ekskul berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

}
