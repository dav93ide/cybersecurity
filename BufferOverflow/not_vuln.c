#include <stdlib.h>
#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[]){
  char *buf;

  buf = (char*) malloc(1024);
  printf("[+] buf = '%p' ", buf);

  strcpy(buf, argv[1]);
  free(buf);
}
