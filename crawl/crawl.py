import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse

# Specify the base URL of your website
base_url = 'https://klbtheme.com/machic/'

# Function to create a directory to save the files
def create_directory(directory):
  if not os.path.exists(directory):
    os.makedirs(directory)

# Function to download a file
def download_file(url, save_path):
  try:
    response = requests.get(url)
    response.raise_for_status()
    with open(save_path, 'wb') as file:
      file.write(response.content)
    print(f'Successfully downloaded {save_path}')
  except requests.exceptions.RequestException as e:
    print(f'Failed to download {url}: {e}')

# Function to crawl the website
def crawl_website(base_url):
  visited = set()
  to_visit = [base_url]

  while to_visit:
    current_url = to_visit.pop(0)
    if current_url in visited:
      continue

    print(f'Crawling {current_url}')
    try:
      response = requests.get(current_url)
      response.raise_for_status()
    except requests.exceptions.RequestException as e:
      print(f'Failed to retrieve {current_url}: {e}')
      continue

    soup = BeautifulSoup(response.text, 'html.parser')
    links = soup.find_all('a', href=True)
    
    for link in links:
      file_url = urljoin(base_url, link['href'])
      parsed_url = urlparse(file_url)
      if parsed_url.netloc != urlparse(base_url).netloc:
        continue  # Skip external links

      # Filter out only source files (you can adjust the filter as needed)
      if file_url.endswith('.py'):
        file_name = os.path.basename(parsed_url.path)
        save_path = os.path.join('downloaded_files', file_name)
        
        print(f'Downloading {file_name} from {file_url}')
        download_file(file_url, save_path)
      elif file_url not in visited:
        to_visit.append(file_url)

    visited.add(current_url)

if __name__ == '__main__':
  create_directory('downloaded_files')
  crawl_website(base_url)
