<?php

namespace pkmnfriends\Http\Controllers\Administrator\Files;

use pkmnfriends\Infrastructure\Controllers\ControllerAbstract;
use pkmnfriends\Domain\Files\Files\Repositories\FilesRepository;

class FilesController extends ControllerAbstract
{

    /**
     * @var null
     */
    protected $rFiles = null;

    /**
     * FilesController constructor.
     *
     * @param FilesRepository $rFiles
     */
    public function __construct(FilesRepository $rFiles)
    {
        $this->rFiles = $rFiles;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(
            'administrator.files.files.index',
            $this->rFiles->getViewVars()
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connector()
    {
        return $this->rFiles->connector();
    }
}
