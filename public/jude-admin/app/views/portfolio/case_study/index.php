<?php
    $title = json_decode($data['projectData'][0]['project_data'], true)['project_title'] .' || ';
    include './public/components/header.php';
    $get_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . explode('admin.', $_SERVER["HTTP_HOST"])[1];
?>
    </head>

    <body id="case-study-body">
        <?php
            foreach ($data['projectData'] as $key => $projectData)
            {
                $project_data =  array_filter(json_decode($projectData['project_data'], true));

                echo '
                    <div class="wrapper" id="top">
                        <header class="landing" id="home">
                            <div class="case-study-title">
                                <div class="case-study-title-top">
                                    <a href="/portfolio" class="return-button">
                                        <i class="las la-arrow-left "></i>
                                        <h5 class="p5">Return to Portfolio Page</h5>
                                    </a>
                                    <div class="title-text">
                                        <h1>'.$project_data['project_title'].'</h1>
                                        <p class="p4">'.$project_data['project_description'].'</p>
                                        <p class="p4">Project Duration: '.$projectData['project_duration'].'</p>
                                    </div>
                                    <div class="tags-row">
                                        <div>
                                            <a href="/portfolio/edit/'.$projectData['unique_id'].'" class="p5 secondary" id="tag-single" data-show="ui/ux">Edit this project</a>
                                        </diV>
                                    </div>
                                </div>
                                <div class="scroll-down-indicator">
                                    <div class="scroll-down">
                                        <div class="mouse">
                                            <div id="arrow-tail-short"></div>
                                        </div>
                                        <div id="arrow-tail-long"></div>
                                    </div>
                                    <p class="p5">Scroll down</p>
                                </div>
                            </div>
                            <div class="case-study-img" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7) , rgba(0, 0, 0, 0.7)), url(\''.$get_url.$projectData['project_img_directory'].$projectData['project_cover_img'].'\');">
                            </div>
                        </header>
                        <article id="body ">
                            <div class="portfolio-section">';
                            
                            $body_project_data = array_splice($project_data, 3);

                            foreach ($body_project_data as $key => $body_data)
                            {
                                $section_heading = ucwords(str_replace("_", " ", $key));

                                if(!is_array($body_data))
                                {
                                    echo'
                                        <div class="text-divider">
                                            <h2>';
                                                if($section_heading !== 'Project Duration')
                                                {
                                                    echo str_replace('Project ', '', $section_heading);

                                                }elseif ($section_heading == 'Project Role')
                                                {
                                                    echo str_replace('Project', 'My', $section_heading);

                                                }elseif ($section_heading == 'Project Solution')
                                                {
                                                    echo str_replace('Project', 'The', $section_heading);
                                                }else{
                                                    echo $section_heading;
                                                }
                                            echo
                                            '</h2>
                                            <div id="liner"></div>
                                            <p class="p4">';
                                                if($section_heading == 'Project Website')
                                                {
                                                    echo '<a class="case-study-link" href="'.$body_data.'">'.$body_data.'</a>';
                                                }else{
                                                    echo $body_data;
                                                }
                                            echo
                                            '</p>
                                        </div>                                    
                                    ';
                                }else{
                                    echo'
                                        <div class="text-divider">';
                                            if($key == 'Website')
                                            {
                                                echo '<h2>Details</h2>';
                                            }else{
                                                echo '<h2>'.$key.'</h2>';
                                            }

                                            echo'<div id="liner"></div>';

                                            if (array_key_exists("summary", $body_data))
                                            {
                                                echo '<p class="p4">'.$body_data['summary'].'</p>';
                                                unset($body_data['summary']);
                                            }
                                        echo'
                                        </div>
                                    ';

                                    foreach ($body_data as $sub_title => $contents)
                                    {
                                        if(is_array($contents))
                                        {
                                            if (array_key_exists("personae_img", $contents) || array_key_exists("research_img", $contents))
                                            {
                                                $personae = 'personae';
                                                $notice = '';
                                            }elseif (array_key_exists("hiFI_img", $contents) || array_key_exists("wireframes_img", $contents))
                                            {
                                                $personae = 'grid';
                                                $notice = 'Click on the images to view their respective larger sizes';
                                            }else
                                            {
                                                $personae = '';
                                                $notice = '';
                                            }
                                            echo'
                                                <div class="text-divider sub-title">
                                                    <div class="left">
                                                        <h3>'.$sub_title.'</h3>';
                                                        if (!is_array($contents))
                                                        {
                                                            echo '<p class="p4">'.$contents.'</p>';
                                                        }else{
                                                            if (array_key_exists("summary", $contents))
                                                            {
                                                                echo '<p class="p4">'.$contents['summary'].'</p>';
                                                                unset($contents['summary']);
                                                            }
                                                        }
                                                echo'
                                                    </div>
                                                </div>
                                                <div class="projects-holder">
                                                    <div class="notice">
                                                        <p class="p5">'.$notice.'</p>
                                                    </div>
                                                    <div class="row '.$personae.'">';
                                                        foreach ($contents as $images_alt_title => $images)
                                                        {
                                                            foreach ($images as $image)
                                                            {
                                                                echo'
                                                                    <div class="project">
                                                                        <img src="'.$get_url.$projectData['project_img_directory'].$image.'" alt="'.ucwords(str_replace("_", " ", $images_alt_title)).'">
                                                                    </div>
                                                                ';
                                                            }
                                                        }
                                                    echo '
                                                    </div>
                                                </div>
                                            ';
                                        }else{
                                            if($sub_title == 'prototype')
                                            {
                                                echo '
                                                    <div class="text-divider sub-title">
                                                        '.$contents.'
                                                    </div>
                                                ';
                                            }else{
                                                echo'
                                                    <div class="text-divider sub-title">
                                                        <h3>'.$sub_title.'</h3>
                                                        <p class="p4"><a class="case-study-link" href="'.$contents.'" target="_blank">'.$contents.'</a></p>
                                                    </div>
                                                ';
                                            }
                                        }
                                    }
                                }
                            }

                            echo'
                                <a href="/portfolio" class="return-button">
                                    <i class="las la-arrow-left "></i>
                                    <h5>Return to Portfolio Page</h5>
                                </a>
                            </div>
                        </article>
                    </div>
                ';
            }
            include './public/components/footer.php';
        ?>
        <span id="close"><i class="las la-times"></i></span>
        <div class="modal hideout">
            <div class="img-holder">
                <img src="" id="larger"/>
            </div>
        </div>
    </body>

    </html>