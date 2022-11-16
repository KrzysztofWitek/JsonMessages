docker_up:
	docker compose up -d --build;
	docker exec -it json_messages_php /bin/bash;