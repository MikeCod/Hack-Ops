#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int main() {
	srand(time(NULL));

	// creating file pointer to work with files
	FILE *fptr;

	// opening file in writing mode
	fptr = fopen("/home/ch-cc-1/captcha.txt", "w");

	// exiting program
	if (fptr == NULL) {
		printf("Error!");
		return 1;
	}

	char symbol[] = "+-/*";

	fprintf(fptr, "%u %c %u", rand(), symbol[rand() % strlen(symbol)], rand());
	fclose(fptr);
	return 0;
}
