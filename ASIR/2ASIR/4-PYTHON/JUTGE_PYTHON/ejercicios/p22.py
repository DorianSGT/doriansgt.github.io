import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])
    if n == 0:
        print(0)
    else:
        print(bin(n)[2:][::-1])