#include <stdio.h>
#include <unistd.h>

int main(int argc, char *argv[]){
	FILE *secret = fopen("flag", "rt");
	char buffer[80];
	fgets(buffer, 8, secret);
	printf(argv[1]);
	fclose(secret);
	return 0;
}


