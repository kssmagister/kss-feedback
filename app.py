import os
import pandas as pd
import openai
from datetime import datetime

# Setzen Sie Ihren OpenAI-API-Schlüssel hier
openai.api_key = 'sk-sS2...' # adjust

def get_latest_csv(directory):
    """Holen Sie sich die jüngste CSV-Datei aus dem angegebenen Verzeichnis."""
    all_files = [os.path.join(directory, f) for f in os.listdir(directory) if f.endswith('.csv')]
    all_files.sort(key=lambda x: os.path.getctime(x))
    return all_files[-1]

def evaluate_with_openai(answer):
    """Verwenden Sie OpenAI, um eine Antwort auszuwerten."""
    try:
        prompt = f"Fasse den Inhalt in einem Satz zusammen: {answer}"
        response = openai.ChatCompletion.create(
            model="gpt-3.5-turbo",
            messages=[
                {"role": "system", "content": "You are a helpful assistant."},
                {"role": "user", "content": prompt}
            ],
            temperature=1,
            max_tokens=256,
            top_p=1,
            frequency_penalty=0,
            presence_penalty=0)
        evaluation = response.choices[0].message['content'].strip()
        return evaluation
    except Exception as e:
        print(f"Fehler bei der Auswertung: {e}")
        return answer

def main():
    # Importieren Sie die jüngste CSV-Datei
    csv_file_path = get_latest_csv('/home/...') #adjust
    df = pd.read_csv(csv_file_path)

    # Holen Sie den Wert der Auswahl aus der ersten Zeile
    kl = df.iloc[0]['auswahl']

    # Auswertung mit OpenAI
    evaluations = []
    for index, row in df.iterrows():
        evaluation = evaluate_with_openai(row['texteingabe'])
        evaluations.append(evaluation)

    prompt_summary = "Fasse die folgenden Auswertungen zusammen:\n" + "\n".join(evaluations)
    summary_response = openai.ChatCompletion.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a helpful assistant."},
            {"role": "user", "content": prompt_summary}
        ],
        temperature=1,
        max_tokens=256,
        top_p=1,
        frequency_penalty=0,
        presence_penalty=0)
    summary = summary_response.choices[0].message['content'].strip()

    prompt_notes = f"Erstelle Notizen in Listenform, die den wesentlichen Inhalt der folgenden Zusammenfassung enthalten:\n{summary}"
    notes_response = openai.ChatCompletion.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a helpful assistant."},
            {"role": "user", "content": prompt_notes}
        ],
        temperature=1,
        max_tokens=256,
        top_p=1,
        frequency_penalty=0,
        presence_penalty=0)
    notes = notes_response.choices[0].message['content'].strip()

    ts = datetime.now().strftime("%Y-%m-%d:%H:%M")
    folder_path = "/home/..." # adjust
    summary_file_name = f'{folder_path}/{kl}-feedback-{ts}.txt'
    with open(summary_file_name, 'w', encoding='utf-8') as file:
        file.write(f"Titel: {kl}\n\n")  
        file.write(notes)

    print(f"Zusammenfassung und Notizen erfolgreich als {summary_file_name} gespeichert!")

if __name__ == '__main__':
    main()
