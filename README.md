
# Blogging Platform CMS

A Blogging Platform CMS using the Laravel TALL Stack.


[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)
![GitHub last commit (by committer)](https://img.shields.io/github/last-commit/voiceinthedark/blogging-platform-cms)


## Features

- Complete CRUD system for Posts
- Comments and replies on posts
- Like systems for Posts and Comments
- Follower system, users can follow and unfollow other users.
- User profile pages
- Posts are indexed with Scout on Meilisearch, searching for posts is blazingly fast.
- User Feed page with post recommender system
- User direct messaging system


## Tech Stack

**Client:** Alpinejs, TailwindCSS, javascript

**Server:** php, laravel, livewire, mySql, meilisearch


## Screenshots

### Main Page
![main page](2023-07-18-18-35-07.png)
### Dynamic search
![Dynamic search](2023-07-18-18-38-15.png)
### User dashboard
![user dashboard](2023-07-18-18-39-00.png)
### Search by category
![search by category](2023-07-18-18-39-48.png)
### Post Creation
![post creation](2023-07-18-18-46-25.png)
#### dynamic lookup for tags and categories
![](2023-07-18-18-48-08.png)
![](2023-07-18-18-49-46.png)
### page viewer
![](2023-07-18-18-51-12.png)
### comment and like system
![](2023-07-18-18-52-35.png)
### Follower system
![](2023-07-18-18-53-30.png)
### User profile
![](2023-07-18-18-54-58.png)
### Direct Message system
![](2023-07-18-18-56-21.png)


## Run Locally

Clone the project

```bash
  git clone git@github.com:voiceinthedark/blogging-platform-cms.git
```

Go to the project directory

```bash
  cd blogging-platform-cms
```

Install dependencies

```bash
  docker build -t sail .
  npm install
```

Start the server

```bash
  sail up -d
  npm run dev
```


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`cp .env.example .env`
And fill the DB_HOST name with your db




## Usage/Examples

```bash
sail artisan migrate --seed

```

## Progress
![Static Badge](https://img.shields.io/badge/Progress-78-%25?color=orange)


## Roadmap

- [x] Add Post notification
- [x] Refactor and improve post creation/editing view
- [x] Add Feed page
- [x] Add DM system
- [x] Add recommender system
- [ ] Fix minor bugs

## Coding time
[![wakatime](https://wakatime.com/badge/user/9bdfcd03-4538-464c-86ab-3fb8cf66f7b6/project/7b155d60-fec9-4154-b381-29291af189aa.svg?style=for-the-badge)](https://wakatime.com/badge/user/9bdfcd03-4538-464c-86ab-3fb8cf66f7b6/project/7b155d60-fec9-4154-b381-29291af189aa)

### time by components
![](2023-07-19-08-34-14.png)



## Feedback

If you have any feedback, please reach out at darkrisingforce@gmail.com


## Acknowledgements

- https://icons8.com/
- https://flowbite.com/
- https://ui.toast.com/
- https://github.com/wireui/wireui

# Hi, I'm Firas! 👋


## 🚀 About Me
I'm a full stack developer, curently working with the TALL stack (Tailwind, Alpinejs, Laravel and Livewire).


## 🛠 Skills
javascript, php, python and React

