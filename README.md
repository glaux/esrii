# esrii
This repository contains the code and project management tools for the esrii conferences.

### License information

Copyright (c) 2019 Nicolaj Knudsen

This project is free software. There is no warranty; not even for
merchantability or fitness for a particular purpose.

See the file LICENSE-MIT.md for details.

3rd party libraries and the site content including images are exempt. This includes, but is not nessecarily limited to, the contents of the directories (and their sub directories): ```public_html/img```, ```public_html/pages```, ```public_html/pdf```, ```public_html/vendor``` and ```public_html/vendor_js```. For 3rd party scripts, see the included licence information. For images, written prose and other media files you must seek written permission from the original creators for reuse outside the esrii organisation.

### Run the project

Create the .env file in the document root by copying the sample and fill the keys correctly.

Run the [reverse proxy docker+letsencrypt companion](https://github.com/evertramos/docker-compose-letsencrypt-nginx-proxy-companion)

Run ```docker-compose up``` in the project.
