<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CsvController extends Controller
{
    //
    public function index()
    {
      return view('home');
    }

    public function import(Request $request)
    {
      $this->validate($request, [
        'file' => 'required'
      ]);

      //JIKA FILE ADA
      if ($request->hasFile('file')) {
          //GET FILE NYA
          $file = $request->file('file');
          //MEMBUAT FILENAME DENGAN MENGAMBIL EKSTENSI DARI FILE YANG DI-UPLOAD
          //$sansextension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
          $filename = time() . '-' . $file->getClientOriginalName();

          //FILE TERSEBUT DISIMPAN KEDALAM FOLDER
          // STORAGE > APP > PUBLIC > IMPORT
          //DENGAN MENGGUNAKAN METHOD storeAs()
          $file->storeAs(
              'public/import', $filename
          );

          //REDIRECT DENGAN FLASH MESSAGE BERHASIL
          return redirect()->back()->with(['success' => 'Upload success']);
        }
          //JIKA TIDAK ADA FILE, REDIRECT ERROR
        return redirect()->back()->with(['error' => 'Failed to upload file']);

      }
  }
