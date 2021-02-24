<?php

declare(strict_types=1);

namespace MLL\GraphQLVoyager;

use Illuminate\Contracts\View\View;

class GraphQLVoyagerController
{
    public function __invoke(): View
    {
        return view('graphql-voyager::index');
    }
}
