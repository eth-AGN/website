## Getting Started

### Installation

It is assumed you have the following tools installed on your system:
- Git
- Docker Compose (https://docs.docker.com/compose/install/)
- Yarn (https://classic.yarnpkg.com/en/docs/install/) or alternatively NPM
To get the website running locally:
1. Clone this repository to your system.
2. Run `docker-compose up` inside this folder to start the WordPress server.
3. Run `yarn` to install all JavaScript packages.
4. Run `yarn dev` to start the development server for the frontend.

### Setup
Once the local WordPress instance is running...
1. Change the theme to `Agn_Theme` (under Appearance -> Themes)
2. Create categories with the slugs `wissen`, `denken`, `handeln` (under Posts -> Categories)
3. Optionally create some posts with tags to fill the database with some test data