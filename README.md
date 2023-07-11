
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


## Tech Stack

**Client:** Alpinejs, TailwindCSS, javascript

**Server:** php, laravel, livewire, mySql, meilisearch


## Screenshots

![main page](2023-07-11-03-35-47.png)
![dynamic search](2023-07-11-03-37-59.png)
![user dashboard](2023-07-11-03-38-37.png)
![Post Creation](2023-07-11-03-39-51.png)



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
![Static Badge](https://img.shields.io/badge/Progress-73-%25?color=orange)


## Roadmap

- [x] Add Post notification
- [ ] Refactor and improve post creation/editing view
- [ ] Add Feed page
- [ ] Add DM system
- [ ] Add recommender system


## Feedback

If you have any feedback, please reach out at darkrisingforce@gmail.com


## Acknowledgements

- https://icons8.com/

# Hi, I'm Firas! 👋


## 🚀 About Me
I'm a full stack developer, curently working with the TALL stack (Tailwind, Alpinejs, Laravel and Livewire).


## 🛠 Skills
javascript, php, python and React

