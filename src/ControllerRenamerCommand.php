<?php
namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ControllerRenamerCommand extends Command {
	protected function configure() {
		$this->setName( 'controller:renamer:command' )
			->setDescription( 'This command will search for files inside folders called `controller` with filename starting with lowercase and will rename them to start with uppercase' )
			->addArgument( 'path', InputArgument::REQUIRED, 'The path to search on' )
			->addOption( 'rename-files' );
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$finder = new Finder();

		$path = $input->getArgument( 'path' );
		$path = trim( $path, '/ ' );

		$finder->files()->path( '/.*\/controllers\/[a-z][^\/]*\.php$/' )->in( $path );

		$output->writeln( sprintf( 'There are %d controllers to rename', count( $finder ) ) );
		/** @var SplFileInfo $file */
		foreach( $finder as $file ) {
			//$output->writeln( $file->getPath() );
			$output->writeln( $file->getPathname() );
		}

		if ( $input->getOption( 'rename-files' ) ) {
			foreach( $finder as $file ) {
				rename( $file->getPathname(), $file->getPath() . '/' . ucfirst( $file->getBasename() ) );
			}
		}

		$output->writeln( 'Files renamed!' );
	}


}