import sys
tokens = sys.stdin.read().split()
if len(tokens) < 4:
    sys.exit(0)

a1 = int(tokens[0])
b1 = int(tokens[1])
a2 = int(tokens[2])
b2 = int(tokens[3])

if a1 == a2 and b1 == b2:
    print("=")
elif a2 <= a1 and b1 <= b2:
    print("1")
elif a1 <= a2 and b2 <= b1:
    print("2")
else:
    print("?")