import csv

# Filstier
input_file = '/var/lib/mysql-files/ready_for_mysql.csv'
output_file = '/var/lib/mysql-files/final_ready_for_mysql.csv'

# Rens dataene
with open(input_file, 'r', encoding='utf-8') as infile, open(output_file, 'w', encoding='utf-8', newline='') as outfile:
    reader = csv.reader(infile)
    writer = csv.writer(outfile)

    for i, row in enumerate(reader):
        if i == 0:
            # Behold overskriftene som de er
            writer.writerow(row)
        else:
            # Fjern punktum i navnefeltet
            row[0] = row[0].replace('.', ' ').strip()
            # Rens overflødige mellomrom i alle felter
            cleaned_row = [cell.strip() for cell in row]
            writer.writerow(cleaned_row)
