<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class block extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:block';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = [
            'Hero Header Sections',
            'Header Sections',
            'Feature Sections',
            'CTA Sections',
            'Contact Sections',
            'Pricing Sections',
            'Testimonial Sections',
            'FAQ Sections',
            'Logo Sections',
            'Team Sections',
            'Blog Header Sections',
            'Blog Sections',
            'Blog Posts',
            'Blog Post Headers',
            'Career Sections',
            'Gallery Sections',
            'Contact Modals',
            'Banners',
            'Portfolio Sections',
            'Portfolio Headers',
            'Product List Sections',
            'Event Sections',
            'Event Headers',
            'Event Item Headers',
            'Product Headers',
            'Stats Sections',
            'Multi-step Forms',
            'Category Filters',
            'Long Form Content Sections',
            'Loaders',
            'Application Shells',
            'Sidebars',
            'Topbars',
            'Page Headers',
            'Section Headers',
            'Card Headers',
            'Sign Up and Log In Pages',
            'Sign Up and Log In Modals',
            'Onboarding Forms',
            'Tables',
            'Stacked Lists',
            'Grid Lists',
            'Stat Cards',
            'Forms',
            'Description Lists',
            'Utilities',
            'Archive Posts',
            'Timeline Sections',
            'Footer',
        ];

        $category = sort($categories);

        $category = $this->choice('What category is the block?', $categories);

        $blockName = $this->ask('What is the name of the block?');

        $this->info("Creating a block named '{$blockName}' in the {$category} category.");

        $categoryCamelCase = toCamelCase($category);
        $blockNameCamelCase = toCamelCase($blockName);

        // Construct the file path
        $filePath = base_path("app/fields/blocks/{$categoryCamelCase}/{$blockNameCamelCase}.php");

        // Check if the file already exists
        if (file_exists($filePath)) {
            $this->error("A block with the name '{$blockName}' already exists in the {$category} category.");
            return Command::FAILURE;
        }

        $icon = '';

        if ($category == 'Archive Posts') {
            $icon = '<span class="dashicons dashicons-star-filled"></span>';
        }

        // Prepare the file content
        $fileContent = "<?php\n\n";
        $fileContent .= "use App\\Fields\\Blocks\\BaseBlock;\n";
        $fileContent .= "use StoutLogic\\AcfBuilder\\FieldsBuilder;\n\n";
        $fileContent .= "class {$blockNameCamelCase} extends BaseBlock\n{\n";
        $fileContent .= "    protected \$name = '" . strtolower(str_replace(' ', '_', $blockName)) . "';\n";
        $fileContent .= "    protected \$category = '" . strtolower(str_replace(' ', '_', $category)) . "';\n";

        if ($category == 'Archive Posts') {
            $fileContent .= "    public \$pageDisplay = 'page_for_CUSTOM_POST';\n";
        }

        $fileContent .= "\n";

        $fileContent .= "    public function defineFields()\n    {\n";
        $fileContent .= "        \$block = new FieldsBuilder(\$this->name, [\n";
        $fileContent .= "            'title' => '{$icon}{$blockName}',\n";
        $fileContent .= "            'display' => 'block',\n";
        $fileContent .= "        ]);\n\n";
        $fileContent .= "        // DON'T REMOVE THIS\n";
        $fileContent .= "        \$block->addText('block_category_name', [\n";
        $fileContent .= "            'default_value' => '{$categoryCamelCase}',\n";
        $fileContent .= "            'readonly' => 1,\n";
        $fileContent .= "            'wrapper' => ['class' => 'hidden'],\n";
        $fileContent .= "        ]);\n\n";
        $fileContent .= "        \$block->addText('heading', [\n";
        $fileContent .= "            'label' => 'Heading',\n";
        $fileContent .= "            'required' => 1,\n";
        $fileContent .= "        ]);\n\n";
        $fileContent .= "        return \$block;\n";
        $fileContent .= "    }\n";
        $fileContent .= "}";

        // Check if the directory exists, if not create it
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            try {
                mkdir($directory, 0777, true); // The 0777 permission will be modified by the current umask
            } catch (\Exception $e) {
                $this->error("Failed to create directory: " . $e->getMessage());
                return Command::FAILURE;
            }
        }

        // Create the file
        try {
            file_put_contents($filePath, $fileContent);
            $this->info("Block named '{$blockName}' created in the {$category} category.");
        } catch (\Exception $e) {
            $this->error("Error creating the block: " . $e->getMessage());
            return Command::FAILURE;
        }

        // Create component
        $className = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($blockName))));

        $input = new ArrayInput([
            'name' => 'blocks/' . "$categoryCamelCase/" . (str_replace(' ', '', $className)),
        ]);

        $output = new BufferedOutput();

        $componentCommand = $this->getApplication()->find('make:component');
        $componentCommand->run($input, $output);

        $this->info($output->fetch());

        return Command::SUCCESS;
    }

}
