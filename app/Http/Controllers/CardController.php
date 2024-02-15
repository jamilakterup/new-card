<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::all();
        return view('adminTemplate.pages.allCards', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminTemplate.pages.addCard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'front_pdf' => 'required|mimes:pdf',
            'back_pdf' => 'required|mimes:pdf',
        ]);

        $cards = new Card();
        if ($request->hasFile('front_image')) {
            $frontImage = $request->file('front_image');
            $frontFileExt = $frontImage->getClientOriginalExtension();
            $frontFileName = 'front_' . uniqid() . "." . $frontFileExt;
            $frontImage->storeAs('cards', $frontFileName, 'public');
            $cards->front_image = 'cards/' . $frontFileName;
        }
        if ($request->hasFile('back_image')) {
            $backImage = $request->file('back_image');
            $backFileExt = $backImage->getClientOriginalExtension();
            $backFileName = 'back_' . uniqid() . "." . $backFileExt;
            $backImage->storeAs('cards', $backFileName, 'public');
            $cards->back_image = 'cards/' . $backFileName;
        }
        if ($request->hasFile('front_pdf')) {
            $frontPDF = $request->file('front_pdf');
            $frontPdfExt = $frontPDF->getClientOriginalExtension();
            $frontPdfName = 'front_' . uniqid() . "." . $frontPdfExt;
            $frontPDF->storeAs('cards', $frontPdfName, 'public');
            $cards->front_pdf = 'cards/' . $frontPdfName;
        }
        if ($request->hasFile('back_pdf')) {
            $backPDF = $request->file('back_pdf');
            $backPdfExt = $backPDF->getClientOriginalExtension();
            $backPdfName = 'back_' . uniqid() . "." . $backPdfExt;
            $backPDF->storeAs('cards', $backPdfName, 'public');
            $cards->back_pdf = 'cards/' . $backPdfName;
        }

        $cards->save();

        return redirect()->route('card.index')->with('success', 'card has been uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Card::find($id);
        return view('adminTemplate.pages.addCard', \compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cards = Card::find($id);
        if ($request->hasFile('front_image')) {
            $frontImage = $request->file('front_image');
            $frontFileExt = $frontImage->getClientOriginalExtension();
            $frontFileName = 'front_' . uniqid() . "." . $frontFileExt;
            $frontImage->storeAs('cards', $frontFileName, 'public');
            $cards->front_image = 'cards/' . $frontFileName;
        }
        if ($request->hasFile('back_image')) {
            $backImage = $request->file('back_image');
            $backFileExt = $backImage->getClientOriginalExtension();
            $backFileName = 'back_' . uniqid() . "." . $backFileExt;
            $backImage->storeAs('cards', $backFileName, 'public');
            $cards->back_image = 'cards/' . $backFileName;
        }
        if ($request->hasFile('front_pdf')) {
            $frontPDF = $request->file('front_pdf');
            $frontPdfExt = $frontPDF->getClientOriginalExtension();
            $frontPdfName = 'front_' . uniqid() . "." . $frontPdfExt;
            $frontPDF->storeAs('cards', $frontPdfName, 'public');
            $cards->front_pdf = 'cards/' . $frontPdfName;
        }
        if ($request->hasFile('back_pdf')) {
            $backPDF = $request->file('back_pdf');
            $backPdfExt = $backPDF->getClientOriginalExtension();
            $backPdfName = 'back_' . uniqid() . "." . $backPdfExt;
            $backPDF->storeAs('cards', $backPdfName, 'public');
            $cards->back_pdf = 'cards/' . $backPdfName;
        }

        $cards->save();

        return redirect()->route('card.index')->with('info', 'card has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Card::find($id);
        $row->delete();

        return redirect()->route('card.index')->with('message', 'Deleted successfully');
    }
}
