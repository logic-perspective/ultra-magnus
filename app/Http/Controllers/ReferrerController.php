<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ReferrerRepository;
use App\Http\Requests\ReferrerEmailChangeRequest;
use App\Http\Requests\ReferrerTokenRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class ReferrerController extends Controller
{

    /**
     * @var ReferrerRepository
     */
    private $referrerRepository;

    /**
     * ReferrerController constructor.
     * @param ReferrerRepository $referrerRepository
     */
    public function __construct(ReferrerRepository $referrerRepository)
    {
        $this->referrerRepository = $referrerRepository;
    }

    /**
     * @param ReferrerTokenRequest $request
     * @return RedirectResponse
     */
    public function getToken(ReferrerTokenRequest $request): RedirectResponse
    {
       try {
           return redirect()
               ->back()
               ->with('referrer-token', $this->referrerRepository->store($request->get('domain'), $request->get('email')));
       } catch (QueryException $exception) {
           return redirect()->back()->with('duplicate-referrer', 'The partner details you entered already exist.');
       }
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function changeToken(int $id): RedirectResponse
    {
        return redirect()->back()->with('referrer-token', $this->referrerRepository->updateToken($id));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroyToken(int $id): RedirectResponse
    {
        $this->referrerRepository->delete($id);
        return redirect()->back()->with('deleted-referrer', 'Access token has been deleted successfully.');
    }

    /**
     * @param ReferrerEmailChangeRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function changeEmail(ReferrerEmailChangeRequest $request, int $id): RedirectResponse
    {
        $this->referrerRepository->updateEmail($request->get('email'), $id);
        return redirect()->back()->with('updated-referrer-email', 'The partner email address has been updated successfully.');
    }
}
