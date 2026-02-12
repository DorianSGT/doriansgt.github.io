import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])
    for i in range(n + 1):
        print(i)