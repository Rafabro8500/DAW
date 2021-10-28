import discord
import os
from dotenv import load_dotenv

load_dotenv()

client = discord.Client()

@client.event
async def on_ready():
    print("I'm alive as {0.user}".format(client))

@client.event
async def on_message(message):
    if message.author == client.user:
        return
    if message.content.startswith(";ligma"):
        await message.channel.send("Ligma what you may ask? Ligma balls")

client.run(os.environ['DISCORD_TOKEN'])