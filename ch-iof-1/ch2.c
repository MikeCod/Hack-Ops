#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <malloc.h>
#include <unistd.h>

void secret_function(){
	printf("Congrats !\nOpening your shell...\n");
	char *argv[] = { "/bin/bash", "-p", NULL };
	execve(argv[0], argv, NULL);
	printf("Shell closed ! Bye.\n");
}

int main(int argc, char *argv[]){
	char *buffer = NULL, *a = NULL, *c = NULL;
	char entry[0xffff];

	scanf("%s", entry);

	unsigned char length = strlen(entry) * sizeof(char);
	a = malloc(16);
	buffer = malloc(length);
	c = malloc(16);

	printf("strlen(entry) = %u\nmalloc_usable_size(buffer) = %u\n", strlen(entry), malloc_usable_size(buffer));
	
	strcpy(a, "test");
	strcpy(c, "test");
	for(int i = 0; i < strlen(entry) ; ++i)
		buffer[i] = entry[i];
	
	printf("c = '%s'\nstrlen(c) = %u\n", c, strlen(c));
	
	free(a);
	free(c);
	free(buffer);

	return 0;
}
