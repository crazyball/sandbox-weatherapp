<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Controller;

use GuzzleHttp\Exception\ClientException;
use SimpleBus\SymfonyBridge\Bus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use WeatherApp\Command\GetWeatherDataForTileQuery;
use WeatherApp\Repository\TileRepository;

/**
 * HomeController
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class HomeController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeController constructor.
     *
     * @param CommandBus         $commandBus
     * @param Environment        $twig
     */
    public function __construct(CommandBus $commandBus,Environment $twig)
    {
        $this->commandBus = $commandBus;
        $this->twig = $twig;
    }

    /**
     * @param TileRepository $TileRepository
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(TileRepository $TileRepository): Response
    {
        try {
            $weatherCards = [];
            $userCards = $TileRepository->findAll();
            foreach ($userCards as $key => $tile) {
                $command = new GetWeatherDataForTileQuery($tile);
                $this->commandBus->handle($command);
                $weatherCards[$key] = $command->getResponse();
            }
        } catch (ClientException $e) {
            $userCards = [];
            $weatherCards = [];
            $this->addFlash('warning', $this->get('translator')->trans('message.service_temporary_offline'));
        }

        return new Response($this->twig->render('home.html.twig', [
            'userCards'    => $userCards,
            'weatherCards' => $weatherCards
        ]));
    }
}