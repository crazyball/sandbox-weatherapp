<?php

namespace WeatherApp\Controller;

use SimpleBus\SymfonyBridge\Bus\CommandBus;
use Symfony\Component\Translation\TranslatorInterface;
use WeatherApp\Command\CreateTileCommand;
use WeatherApp\Command\DeleteTileCommand;
use WeatherApp\Command\GetTileQuery;
use WeatherApp\Command\GetTilesQuery;
use WeatherApp\Entity\Tile;
use WeatherApp\Form\TileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * AdminController
 *
 * @Route("/{_locale}/admin/cards")
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class AdminController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * AdminController constructor.
     *
     * @param CommandBus          $commandBus
     * @param TranslatorInterface $translator
     */
    public function __construct(CommandBus $commandBus, TranslatorInterface $translator)
    {
        $this->commandBus = $commandBus;
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="city_card_index", methods="GET")
     */
    public function index(): Response
    {
        $command = new GetTilesQuery();
        $this->commandBus->handle($command);
        $Tiles = $command->getResponse();

        return $this->render('Admin/index.html.twig', ['city_cards' => $Tiles]);
    }

    /**
     * @Route("/new", name="city_card_new", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $Tile = new Tile();
        $form = $this->createForm(TileType::class, $Tile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new CreateTileCommand($Tile);
            $this->commandBus->handle($command);
            $this->addFlash('success', $this->translator->trans('admin.add.success'));

            return $this->redirectToRoute('city_card_index');
        }

        return $this->render('Admin/new.html.twig', [
            'city_card' => $Tile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="city_card_show", methods="GET")
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id): Response
    {
        $command = new GetTileQuery($id);
        $this->commandBus->handle($command);
        $Tile = $command->getResponse();

        return $this->render('Admin/show.html.twig', ['city_card' => $Tile]);
    }

    /**
     * @Route("/{id}/delete", name="city_card_delete", methods="GET")
     *
     * @param int $id
     *
     * @return Response
     */
    public function delete($id): Response
    {
        $command = new DeleteTileCommand($id);
        $this->commandBus->handle($command);

        $this->addFlash('success', $this->translator->trans('admin.delete.success'));

        return $this->redirectToRoute('city_card_index');
    }
}
