// (gdb) maintenance info sections

#include <stdlib.h>
#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[]){
  char *buf;
  char *buf2;

  buf = (char*) malloc(1024);
  buf2 = (char*) malloc(1024);
  printf("[+] buf = '%p' \n[+] buf2 = '%p' \n", buf, buf2);
  strcpy(buf, argv[1]);
  free(buf2);

}
