                // saving the last watched file in the directory
                $last_watched_file[$user_data["current_directory"]] = $directory; 
                
                // saving the last watched file in the category

                $seperated_path = explode("/", $directory);

                // deciding in which category the user currently is
                switch (true) {
                    case in_array("filme", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "filme"] = $directory;
                        break;
                    case in_array("serien", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "serien"] = $directory;
                        break;
                    case in_array("hoerspiele", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "hoerspiele"] = $directory;
                        break;
                    case in_array("puppen", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "puppen"] = $directory;
                        break;
                }

                saving_user_data($last_watched_file, "last_watched_file.json");