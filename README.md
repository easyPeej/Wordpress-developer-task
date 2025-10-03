The project is based on the Blankslate theme (https://en-gb.wordpress.org/themes/blankslate/) 
It includes:
- A customised blankslate theme with Vite for SASS/JS compilation
- Carbon Fields (installed via Composer) for custom blocks
- A custom plugin for Case Studies

Installation
I used LocalWP to create this project so its probably best to start there, install LocalWP on your machine, then boot up a new site by clicking 'Add New Site' in the bottom corner. 
Once you have a new site loaded up, download the zip file from the repo, and copy over to your new project files:
- Unpack the zip file, go into the wp-content folder
- copy Blankslate (in themes folder) into /wp-content/themes/ 
- copy plugins into /wp-content/
- then copy over both json files into your root file

- To get Carbon Fields working we need to run a command
- in your terminal, in root run 'composer install'

- To get Vite working we need to run a command also but from inside the blankslate folder
- In terminal make sure to be in \public\wp-content\themes\blankslate then run 'npm install' then 'npm run build'

Setup
Once those steps are done, you can open your wp admin panel via LocalWP. Couple of steps to ensure everythings works nicely:
- Go into Appearance, themes then select the blankslate theme to activate
- Go to plugins, click activate under Case Studies plugin.
- Go to settings, permalinks and just click save. This should save some issues with permalinks not working correctly. 

From here you are free to use the custom content block to create comments:
- Click add post on the admin bar at the top, click the plus sign, then drag and drop the 'Custom Content Box'.

From the same screen you can add a custom box that display the latest case studies:
- follow the same steps, but drag in the 'Latest Case Studies'.

Speaking of case studies, we can create those by hovering over 'new' on the admin bar, you will see case study:
- Click case study, fill in the form toward the bottom, not forgetting to give it a title at the top.

Once thats published the latest case study will display them up to 3 at a time (unless spevified otherwise).


