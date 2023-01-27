<?php

namespace App\Http\Livewire;

use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Livewire\Component;
use Livewire\WithPagination;

class TournamentSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;
    public $format = null;
    public $status = null;

    protected $queryString = ['search', 'format', 'status'];

    public function mount()
    {
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }

    public function render()
    {
        $tournaments = Tournament::query();

        $canViewUnlisted = auth()->user()?->can('viewUnlisted', Tournament::class);

        if (!$canViewUnlisted) {
            $tournaments->whereNot('status', TournamentStatus::Unlisted);
        }

        if (stringHasValue($this->search)) {
            $tournaments->where('name', 'like', sprintf('%%%s%%', $this->search));
        }

        if (stringHasValue($this->format)) {
            $tournaments->where('format', $this->format);
        }

        if (stringHasValue($this->status)) {
            $tournaments->where('status', $this->status);
        }

        return view('livewire.tournament-search', [
            'tournaments' => $tournaments->orderByDesc('id')->paginate(10)
        ]);
    }
}
