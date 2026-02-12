
n = int(input())

horas = n // 3600
resto = n % 3600
minutos = resto // 60
segundos = resto % 60

print(horas, minutos, segundos)