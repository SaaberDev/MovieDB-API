<?php

    namespace App\Http\Controllers;

    use App\Repository\MovieDB;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class HomeController extends Controller
    {
        private MovieDB $movieDB;

        public function __construct(MovieDB $movieDB)
        {
            $this->movieDB = $movieDB;
        }

        /**
         * Display a listing of the resource.
         *
         * @return Application|Factory|View|Response
         */
        public function index()
        {
            $topRatedMovies = $this->movieDB->topRated()->take(5);
            $popularMoviesRight = $this->movieDB->popular()->take(2);
            $popularMoviesBottom = $this->movieDB->popular()->take(6)->except([0, 1]);
            return view('index', compact('topRatedMovies', 'popularMoviesRight', 'popularMoviesBottom'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Application|Factory|View|Response
         */
        public function list()
        {
//            $m = $this->movieDB->search('', 1);
//            dd($m);
            return view('pages.movie_list');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
