<?php get_header(); ?>

<?php //the_content();


include __DIR__ . '/vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/assets/components/');
$twig = new \Twig\Environment($loader);
$components = [];
foreach (
    array_merge(
        glob(__DIR__ . '/assets/components/**/*.twig'),
        glob(__DIR__ . '/assets/components/*.twig')
    ) as $twig_template) {
    $filename_split = explode('/', $twig_template);
    $filename_key = $filename_split[count($filename_split) - 1];
    $folder_key = $filename_split[count($filename_split) - 2];
    $parent_folder_key = $filename_split[count($filename_split) - 3];

    echo $folder_key . '/' . $filename_key . '<br>';

    try {
        $components[$parent_folder_key . '/' . $folder_key] = $twig->load($folder_key . '/' . $filename_key);
    } catch (\Twig\Error\LoaderError $e) {
        echo "<br>" . $e->getMessage();
    } catch (\Twig\Error\RuntimeError $e) {
        echo "<br>" . $e->getMessage();
    } catch (\Twig\Error\SyntaxError $e) {
        echo "<br>" . $e->getMessage();
    }
}

//                            $components['components/accordion'] = $twig->load('/components/accordion/template.twig');


//                            foreach (get_field('content') as $content) {
//                                var_dump($components['components/' . $content['acf_fc_layout']]);
//                                echo $components['components/' . $content['acf_fc_layout']]->render($content);
//                            }


?>

<?php get_footer(); ?>
