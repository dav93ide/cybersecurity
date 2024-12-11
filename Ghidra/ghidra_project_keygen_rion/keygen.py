import random
import string

choices = string.ascii_uppercase + string.digits

def keycheck(key):
	print("Trying Key: %s" % key);
	sum = 0
	for k in key:
		sum = (sum + ord(k) >> 1) % 3840 + 10
	final = chr(sum)
	if(final in choices):
		key += final
		print("Key Succeed = %s" % key)
	else:
		print("Key Failed")
		keygen()
	
	
def keygen():
	key = ""
	for i in range(0,15):
		key += random.choice(choices)
	keycheck(key)
	
if __name__ == "__main__":
	keygen()
