import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse
from concurrent.futures import ThreadPoolExecutor

# Specify the base URL of your website
base_url = 'https://klbtheme.com/machic/'

# Function to create a directory to save the files
def create_directory(directory):
    if not os.path.exists(directory):
        os.makedirs(directory)

# Function to download a file
def download_file(url, save_path):
    try:
        response = requests.get(url, timeout=10)
        response.raise_for_status()
        with open(save_path, 'wb') as file:
            file.write(response.content)
        print(f'Successfully downloaded {save_path}')
    except requests.exceptions.RequestException as e:
        print(f'Failed to download {url}: {e}')

# Function to sanitize and save file immediately
def sanitize_and_save_file(url):
    parsed_url = urlparse(url)
    sanitized_path = os.path.basename(parsed_url.path)
    if sanitized_path:  # Only save if the path is not empty
        save_path = os.path.join('downloaded_files2', sanitized_path)
        # Download the file
        download_file(url, save_path)

# Function to crawl the website
def crawl_website(base_url):
    visited = set()
    to_visit = [base_url]
    with ThreadPoolExecutor(max_workers=10) as executor:
        while to_visit:
            current_url = to_visit.pop(0)
            if current_url in visited:
                continue

            print(f'Crawling {current_url}')
            try:
                response = requests.get(current_url, timeout=10)
                response.raise_for_status()
            except requests.exceptions.RequestException as e:
                print(f'Failed to retrieve {current_url}: {e}')
                continue

            soup = BeautifulSoup(response.text, 'html.parser')
            links = soup.find_all('a', href=True)
            
            for link in links:
                raw_url = link['href']
                file_url = urljoin(base_url, raw_url)
                parsed_url = urlparse(file_url)
                if parsed_url.netloc != urlparse(base_url).netloc:
                    continue  # Skip external links

                # Save all files
                executor.submit(sanitize_and_save_file, file_url)
                if file_url not in visited:
                    to_visit.append(file_url)

            visited.add(current_url)

if __name__ == '__main__':
    create_directory('downloaded_files2')
    crawl_website(base_url)
