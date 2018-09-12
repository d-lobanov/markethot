#!/usr/bin/env bash
cp ./.env.example ./.env
docker-compose down && docker-compose build && docker-compose up
