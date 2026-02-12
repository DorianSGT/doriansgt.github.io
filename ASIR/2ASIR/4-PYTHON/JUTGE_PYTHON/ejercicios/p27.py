import sys

tokens = sys.stdin.read().split()

if tokens:
    n = int(tokens[0])

    while n % 2 == 0:
        print(2)
        n = n // 2 

    d = 3

    while d * d <= n:
        while n % d == 0:
            print(d)
            n = n // d
        d += 2

    if n > 1:
        print(n)