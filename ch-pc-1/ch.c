#include <openssl/sha.h>
#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[])
{
	if(argc == 1)
	{
		printf("No password specified\n");
		return 1;
	}
	SHA256_CTX context;
	unsigned char md[SHA256_DIGEST_LENGTH];
	char hex[65];
	
	SHA256_Init(&context);
	SHA256_Update(&context, (unsigned char*)argv[1], strlen(argv[1]));
	SHA256_Final(md, &context);
	
	for (int i = 0, j = 0; i < 32; ++i, j += 2)
		sprintf(hex + j, "%02x", md[i] & 0xff);

	//printf("%s", hex);
	if(strcmp(hex, "e97407735e49029c96e5708c724fc9ce57b6335dba804a893320fcb7c0a07953") == 0)
		printf("OK");
	else
		printf("NO");
}
