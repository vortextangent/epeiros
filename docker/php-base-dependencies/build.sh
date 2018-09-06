#!/usr/bin/env bash

set -x

source docker_repo.sh


if docker build -t $DOCKER_REPOSITORY/$IMAGE_NAME:latest -t $DOCKER_REPOSITORY/$IMAGE_NAME:$IMAGE_VERSION -t $DOCKER_REPOSITORY/$IMAGE_NAME .; then

    CONTAINER=$(docker create $DOCKER_REPOSITORY/$IMAGE_NAME:latest)
    docker export $CONTAINER | docker import - ${IMAGE_NAME}_flat
    docker login --username $USERNAME --password $PASSWORD $DOCKER_REPOSITORY

    docker push $DOCKER_REPOSITORY/$IMAGE_NAME:latest
    docker push $DOCKER_REPOSITORY/$IMAGE_NAME:$IMAGE_VERSION
else
    echo "Build Failed"
fi
