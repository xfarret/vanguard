<?php

declare(strict_types=1);

namespace App\Livewire\Scripts\Forms;

use App\Models\Script;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * Livewire component for creating a new script.
 *
 * This component handles the form submission and validation for creating a new script.
 */
class UpdateForm extends AbstractScriptForm
{
    public Script $scriptObject;

    /**
     * Initialize the component state.
     */
    public function mount(Script $script): void
    {
        $this->scriptObject = $script;
        $this->label = $script->getAttribute('label');
        $this->script = $script->getAttribute('script');
        $this->type = $script->getAttribute('type');

        $backupTasksProperty = $this->getBackupTasksProperty();

        // Initialize selectedTasks with empty array if no backup tasks exist
        if ($this->scriptObject->getAttribute('backupTasks')->isEmpty()) {
            $this->selectedTasks = [];
        } else {
            $this->selectedTasks = array_fill_keys(
                $backupTasksProperty->pluck('id')->toArray(),
                false
            );
        }

        $backupTaskRelationIds = $this->scriptObject->backupTasks()->pluck('id')->toArray();
        if (! empty($backupTaskRelationIds)) {
            foreach ($backupTaskRelationIds as $backupTaskRelationId) {
                $this->selectedTasks[$backupTaskRelationId] = true;
            }
        }
    }

    /**
     * Handle the form submission for creating a new script.
     *
     * Validates the input, creates a new Script, and redirects to the index page.
     */
    public function submit(): RedirectResponse|Redirector
    {
        $backupTasks = $backupTaskRelationIds = $this->scriptObject->backupTasks()->get();
        foreach ($backupTasks as $backupTask) {
            $backupTask->scripts()->detach($this->scriptObject->getAttribute('id'));
        }

        return $this->submitForm($this->scriptObject);
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('livewire.scripts.forms.update-script');
    }
}
