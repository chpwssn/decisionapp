# decisionapp

This app is designed to help you journal how you've made decisions and to remind you return to that process in order to see how the decision turned out.

# Goals

## V1 Goal

A simple app to record names of decisions that users need to make and reminders for users to fill out their journals.

## V2 Goal

A journaling frontend which can edit journal entries, _encrypt them on the client side_, and transmit to the backend for storage.

## Development

This app uses [laradock](https://laradock.io) for local development, run the following and the app will be available at http://localhost/

```bash
composer install
git submodule init
git submodule update
cd laradock
cp ../laradock-env-example .env
docker-compose up -d nginx mysql
```

Getting a shell in a workspace container:

```bash
docker-compose exec workspace bash
```
