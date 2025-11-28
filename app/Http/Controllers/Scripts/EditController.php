<?php

declare(strict_types=1);

namespace App\Http\Controllers\Scripts;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for editing tags.
 *
 * This controller is responsible for displaying the edit form
 * for a specific tag.
 */
class EditController extends Controller
{
    /**
     * Display the edit form for the specified tag.
     *
     * @param  Request  $request  The incoming HTTP request.
     * @param  Script  $script  The tag to be edited.
     * @return View The view containing the edit form.
     */
    public function __invoke(Request $request, Script $script): View
    {
        return view('scripts.edit', [
            'script' => $script,
        ]);
    }
}
