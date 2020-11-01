<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Product;

class HistoryObserver

{
    /**
     * Handle the History "created" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function created(History $history)
    {
        Product::find($history->product_id)->update([
            'qtd' => $history->final_balance
        ]);
    }

    /**
     * Handle the History "updated" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function updated(History $history)
    {
        //
    }

    /**
     * Handle the History "deleted" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function deleted(History $history)
    {
        //
    }

    /**
     * Handle the History "restored" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function restored(History $history)
    {
        //
    }

    /**
     * Handle the History "force deleted" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function forceDeleted(History $history)
    {
        //
    }
}
