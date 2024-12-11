#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char **argv){
    char *buf, *buf2, *buf3;

    buf = (char*) malloc(1024);
    buf2 = (char*) malloc(1024);
    buf3 = (char*) malloc(1024);
    free(buf2);
    strcpy(buf, argv[1]);
    buf2 = (char*) malloc(1024);
    printf("[+] Done.");

}
