## Getting Started

### Installation

It is assumed you have the following tools installed on your system:
- Git
- Docker Compose (https://docs.docker.com/compose/install/)
- Yarn (https://classic.yarnpkg.com/en/docs/install/) or alternatively NPM
To get the website running locally:
1. Clone this repository to your system.
2. Run `docker-compose up` inside this folder to start the WordPress server (available on `localhost:8080`).
3. Run `yarn` to install all JavaScript packages.
4. Run `yarn dev` to start the development server for the frontend (available on `localhost:3000` by default).

### Setup
Once the local WordPress instance is running...
1. Install all required WordPress plugins:
   - Advanced Custom Fields (v5.9)
   - bbPress
   - TinyMCE Advanced
   - Advanced TinyMCE Configuration
2. Change the theme to `Agn_Theme` (under Appearance -> Themes)
3. Change the permalink format to "Post name" (under Settings -> Permalinks)
4. Get a copy of the live database by visiting [agn.arch.ethz.ch] and creating an export file (under Tools -> Export)
5. Import the created file locally (under Tools -> Import -> WordPress -> Install Now -> Run Importer)