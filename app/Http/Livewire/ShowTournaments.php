<?php

namespace App\Http\Livewire;

use App\Models\Tournament;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTournaments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $format = "";
    public $status = "";

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

        if ($this->search) {
            $tournaments->where('name', 'like', sprintf('%%%s%%', $this->search));
        }

        if ($this->format !== "") {
            $tournaments->where('format', '=', $this->format);
        }

        if ($this->status !== "") {
            $tournaments->where('status', '=', $this->status);
        }

        return view('livewire.tournaments', [
            'tournaments' => $tournaments->orderByDesc('id')->paginate(10)
        ]);
    }
}
