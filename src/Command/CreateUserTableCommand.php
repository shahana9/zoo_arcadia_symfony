<?php

namespace App\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-user-table',
    description: 'Creates the user table and inserts initial users.',
)]
class CreateUserTableCommand extends Command
{
    private $connection;

    public function __construct(Connection $connection)
    {
        parent::__construct();
        $this->connection = $connection;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates the user table and inserts initial users.')
            ->setHelp('This command allows you to create a user table and insert initial users with roles.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Vérification de l'existence de la table user
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();

        var_dump($tables);

        $tableExists = in_array('user', $tables);

        if (!$tableExists) {
            $sqlFilePath = __DIR__ . '/../../scripts/create_user_table.sql';
            $sql = file_get_contents($sqlFilePath);

            if ($sql === false) {
                $io->error('Failed to read SQL file.');
                return Command::FAILURE;
            }

            try {
                $this->connection->executeStatement($sql);
                $io->success('User table created successfully!');
            } catch (\Exception $e) {
                $io->error('Error creating user table: ' . $e->getMessage());
                return Command::FAILURE;
            }
        }

        try {
            // Insert admin, employee, and vet users
            $this->connection->executeStatement("
                INSERT INTO user (email, roles, password) VALUES
                ('admin@example.com', '[\"ROLE_ADMIN\"]', '\$2y\$13\$R9Q.lHsl.TO1xFzK5L5y8eK8hy3hc0HL4V3O6y/NqhdA.P7n6.dfy'),
                ('employee@example.com', '[\"ROLE_EMPLOYEE\"]', '\$2y\$13\$FdYyTgO1JejU/E9d.OxOROaeO2uF7SOmgdGKKOFQ8Y5xNxsR8k8nG'),
                ('vet@example.com', '[\"ROLE_VET\"]', '\$2y\$13\$EPdxj7UpBzZ4lOl8u5sOsu9ry5HlC1uJd/4XqaXx5KOnqM8v74kFu')
            ");

            $io->success('Initial users inserted successfully!');
        } catch (\Exception $e) {
            $io->error('Error inserting initial users: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
