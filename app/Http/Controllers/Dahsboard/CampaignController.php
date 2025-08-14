<?php

namespace App\Http\Controllers\Dahsboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Donasi;

class CampaignController extends Controller
{
    public function campaignIndex()
    {
        $campaign = Campaign::withSum('donasi', 'jumlah')->get();

        $campaigns = Campaign::withSum([
            'donasi as total_verified_donasi' => function ($q) {
                $q->where('status', 'Verified');
            },
            'donasi as total_pending_donasi' => function ($q) {
                $q->where('status', '!=', 'Verified');
            }
        ], 'jumlah')->get();

        return view('admin.campaign.index', compact('campaigns', 'campaign'));
    }

    public function campaignCreate()
    {

        return view('admin.campaign.create');
    }

    public function campaignStore(Request $request)
    {

        $validated = $request->validate([
            'judul'            => 'required',
            'kategori'            => 'required',
            'deskripsi'        => 'required',
            'target_donasi'    => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('campaigns', 'public');
            $validated['gambar'] = $path;
        }

        Campaign::create($validated);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign berhasil ditambahkan.');
    }

    public function campaignEdit(Campaign $campaign)
    {
        return view('admin.campaign.edit', compact('campaign'));
    }

    public function campaignUpdate(Request $request, Campaign $campaign)
    {

        $validated = $request->validate([
            'judul'            => 'required',
            'kategori'            => 'required',
            'deskripsi'        => 'required',
            'target_donasi'    => 'required|numeric',
            'status'           => 'required',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->judul !== $campaign->judul) {
            $validated['slug'] = Str::slug($request->judul);
        }

        if ($request->hasFile('gambar')) {
            if ($campaign->gambar && Storage::disk('public')->exists($campaign->gambar)) {
                Storage::disk('public')->delete($campaign->gambar);
            }

            $path = $request->file('gambar')->store('campaigns', 'public');
            $validated['gambar'] = $path;
        }

        $campaign->update($validated);

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign berhasil diupdate.');
    }

    public function campaignShow(Campaign $campaign)
    {
        $doas = $campaign->doa()->latest()->get();

        $campaign->load(['donasi' => function ($query) {
            $query->orderByRaw("FIELD(status, 'Pending') DESC")
                ->orderBy('created_at', 'desc');
        }]);

        return view('admin.campaign.show', compact('campaign' ,'doas'));
    }

    public function campaignVerifikasi($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = 'Verified';
        $donasi->save();

        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi.');
    }

    public function campaignTolak($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = 'Blocked';
        $donasi->save();

        return redirect()->back()->with('success', 'Donasi telah diblokir.');
    }

    public function campaignDestroy(Campaign $campaign)
    {
        if ($campaign->gambar && Storage::disk('public')->exists($campaign->gambar)) {
            Storage::disk('public')->delete($campaign->gambar);
        }

        $campaign->delete();

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign dan gambar berhasil dihapus.');
    }
}
