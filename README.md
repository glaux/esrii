# esrii
This repository contains the code and project management tools for the esrii conferences.

### License information

Copyright (c) 2019 Nicolaj Knudsen

This project is free software. There is no warranty; not even for
merchantability or fitness for a particular purpose.

See the file LICENSE-MIT.md for details.

3rd party libraries and the site content including images are exempt. This includes, but is not nessecarily limited to, the contents of the directories (and their sub directories): ```public_html/img```, ```public_html/pages```, ```public_html/pdf```, ```public_html/vendor```, ```public_html/vendor_js``` and ```public_html/vendor_css```. For 3rd party scripts, see their included licence information in the source file. For images, written prose and other media files you must seek written permission from the original creators for reuse outside the esrii organisation.

### Installation

Clone the project on a VPS (or dedicated), the recommended location is ```/srv/repositories```.

Make sure the server runs Docker (Digital Ocean has a one click Docker image running on Ubuntu that need very little to none configuration).

Create the ```.env``` file in the document root by copying the sample and fill the keys correctly.

Clone and run the [reverse proxy docker+letsencrypt companion](https://github.com/evertramos/docker-compose-letsencrypt-nginx-proxy-companion). Make sure that your DNS is pointed at the servers public IP and the .env file is updated with the domain information. If this is done correctly the companion containers will take care of all the low level routing.

Run ```docker-compose up``` in the project root to bring the site online. Most changes are deployed immediately on file change (notably when ```git pull``` is called). Proceed with care.

### Development

If developing on the remote machine, it is recommended to clone the project twice, one development and one production version. Change the ```.env``` file in dev to have virtual host https://development.esriiYYYY.org and make changes here. When working correctly, make a commit with ```git commit -am "some description of the changes here"``` from the command line followed by ```git push```. 

Change directory to *production* and run a ```git pull``` command. 

Visual Studio Code has an extension for remote workspaces which make this workflow very easy without having a development environment set up on a local machine (i.e. having docker installed).

### Branching

The final version of the website for the 2019 conference in Copenhagen is placed in the ```esrii2019``` branch for reference.

### Quick documentation

The site is built on the quite minimal Triangle CMS. The engine and template files are contained in ```public_html/src/```.

The content should be put in ```public_html/pages``` with a prefix indicating sort order in menus. Use either raw HTML or HTML enhanced with PHP (use the appropriate extension).

The syle sheets are compiled with SASS. Edit the ```public_html/scss/styles.scss``` file and compile it *inside the container*. That is, run ```docker exec -ti esrii bash``` followed by ```compass watch```.

Any file placed in ```public_html/js``` (or ```public_html/vendor_js```) is automatically aggregated and attached. For simple functions, just edit the z.scripts.js file (the files are aggregated alphabetically, so if order matters add a prefix to the file, hence the 'z').

Have fun!



