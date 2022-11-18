docker_up_v1:
	docker-compose up -d --build;
	docker exec -it json_messages_php /bin/bash;

docker_up_v2:
	docker compose up -d --build;
	docker exec -it json_messages_php /bin/bash;