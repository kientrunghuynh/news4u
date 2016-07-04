<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Sites;
use App\Http\Requests\CreateSitesRequest;
use App\Http\Requests\UpdateSitesRequest;
use Illuminate\Http\Request;



class SitesController extends Controller {

	/**
	 * Display a listing of sites
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $sites = Sites::all();

		return view('admin.sites.index', compact('sites'));
	}

	/**
	 * Show the form for creating a new sites
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.sites.create');
	}

	/**
	 * Store a newly created sites in storage.
	 *
     * @param CreateSitesRequest|Request $request
	 */
	public function store(CreateSitesRequest $request)
	{
	    
		Sites::create($request->all());

		return redirect()->route('admin.sites.index');
	}

	/**
	 * Show the form for editing the specified sites.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$sites = Sites::find($id);
	    
	    
		return view('admin.sites.edit', compact('sites'));
	}

	/**
	 * Update the specified sites in storage.
     * @param UpdateSitesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSitesRequest $request)
	{
		$sites = Sites::findOrFail($id);

        

		$sites->update($request->all());

		return redirect()->route('admin.sites.index');
	}

	/**
	 * Remove the specified sites from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Sites::destroy($id);

		return redirect()->route('admin.sites.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Sites::destroy($toDelete);
        } else {
            Sites::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.sites.index');
    }

}
