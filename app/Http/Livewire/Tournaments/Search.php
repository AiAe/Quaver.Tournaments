<?php

namespace App\Http\Livewire\Tournaments;

use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;
    public $mode = null;
    public $format = null;
    public $status = null;
    public $user = null;
    public $show_unlisted = false;

    protected $queryString = ['search', 'mode', 'format', 'status'];

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

        if($this->user) {
            $tournaments->where('user_id', $this->user->id);
        }

        if(!$this->show_unlisted) {
            $tournaments->whereNot('status', TournamentStatus::Unlisted);
        }

        if (stringHasValue($this->search)) {
            $tournaments->where('name', 'like', sprintf('%%%s%%', $this->search));
        }

        if (stringHasValue($this->mode)) {
            $tournaments->where('mode', $this->mode);
        }

        if (stringHasValue($this->format)) {
            $tournaments->where('format', $this->format);
        }

        if (stringHasValue($this->status)) {
            $tournaments->where('status', $this->status);
        }

        $tournaments->with('metas');

        return view('livewire.tournaments.search', [
            'tournaments' => $tournaments->orderByDesc('id')->paginate(10)
        ]);
    }
}
