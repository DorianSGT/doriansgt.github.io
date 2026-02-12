import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])
    for i in range(1, 11):

        print(f"{n}*{i} = {n*i}")