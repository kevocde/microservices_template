# Microservices Lumen Template
Hi my friend, this is a template of docker with docker composer that will help you to implement multiple applications builded with Lumen or Laravel (whatever).

## Get Started
1. First of all clone this repository in your local environment
2. Check if you have docker and docker compose installed in your local env.
3. Move to the repository
4. And go to each app dir (example: cd apps/app1) and install the dependencies (example: docker run --rm -it --volume=$PWD:/app composer install)
5. Later return to root of the repository and run docker composer up -d
6. That is all, your application will run in their own container

# How it works?
If your check the docker-compose.yml in the root of the repository, you will see an array of configuration related with each app, (a new service position for each app),
The key of the service will be the name of the container, later you will find a "image" key with the image will be used, later, "volumnes" key, with your "local_app_dir" and : "container_app_dir",
Later the key "working_dir" that will define the internal current dir of the container, later "command" key, that will define the command of the container will run, finally you'll find the "ports"
that will expose to your local environment the port.


