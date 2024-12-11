Section   .text

  global  _start

_start:

  mov ebx,0     ->    xor ebx,ebx       > Viene tolto il carattere '0' poiche` e` un carattere nullo che viene tradotto in '\x00', ossia terminatore di stringa il che impedirebbe
                                          di iniettare lo shellcode su un form di input.
  mov eax,1     ->    mov al,1          > 'eax' e` un registro a 32-bit, ma poiche` stiamo spostando un solo intero a 8 bit vengono creati degli '0', quindi dei caratteri null
                                          usando un sotto-sotto-registro di 'eax' risolviamo questo problema.
  int 0x80            int 0x80
